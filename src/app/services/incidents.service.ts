import { HttpClient } from '@angular/common/http';
import { Injectable, PipeTransform } from '@angular/core';
import { Incidents } from '../models/Incidents';
import {
  BehaviorSubject,
  Observable,
  Subject,
  debounceTime,
  delay,
  of,
  switchMap,
  tap,
} from 'rxjs';
import { SortColumn, SortDirection } from './sortable.directive';
import { DecimalPipe } from '@angular/common';
import { RespondentData } from '../models/RespondentData';
import { ResponseData } from '../models/ResponseData';
interface SearchResult {
  countries: Incidents[];
  total: number;
}

interface State {
  page: number;
  pageSize: number;
  searchTerm: string;
  sortColumn: SortColumn;
  sortDirection: SortDirection;
}

const compare = (v1: string | number, v2: string | number) =>
  v1 < v2 ? -1 : v1 > v2 ? 1 : 0;

function sort(
  incident: Incidents[],
  column: SortColumn,
  direction: string
): Incidents[] {
  if (direction === '' || column === '') {
    return incident;
  } else {
    return [...incident].sort((a, b) => {
      if (column === 'reporter') {
        const res = compare(a[column].fullname, b[column].fullname);
        return direction === 'asc' ? res : -res;
      } else if (column === 'respondents') {
        // Handle the case where respondents is null
        const aRespondents = a[column] || [];
        const bRespondents = b[column] || [];
        const res = compare(aRespondents.length, bRespondents.length);
        return direction === 'asc' ? res : -res;
      } else {
        const res = compare(a[column], b[column]);
        return direction === 'asc' ? res : -res;
      }
    });
  }
}

function matches(incident: Incidents, term: string) {
  return (
    incident.reporter.fullname.toLowerCase().includes(term.toLowerCase()) ||
    incident.location.toLowerCase().includes(term.toLowerCase()) ||
    incident.description.toLowerCase().includes(term.toLowerCase())
  );
}

@Injectable({
  providedIn: 'root',
})
export class IncidentsService {
  url$ = 'http://localhost/msbapb/api/reports/';

  private _loading$ = new BehaviorSubject<boolean>(true);
  private _search$ = new Subject<void>();
  private _incidents$ = new BehaviorSubject<Incidents[]>([]);
  private _total$ = new BehaviorSubject<number>(0);
  ALL_INCIDENTS: Incidents[] = [];
  private _state: State = {
    page: 1,
    pageSize: 10,
    searchTerm: '',
    sortColumn: '',
    sortDirection: '',
  };

  constructor(private http: HttpClient) {
    this._search$
      .pipe(
        tap(() => this._loading$.next(true)),
        debounceTime(200),
        switchMap(() => this._search()),
        delay(200),
        tap(() => this._loading$.next(false))
      )
      .subscribe((result) => {
        this._incidents$.next(result.countries);
        this._total$.next(result.total);
      });

    this._search$.next();
  }

  getAllIncidents() {
    return this.http.get<Incidents[]>(this.url$ + 'incidents.php');
  }
  setIncidents(incident: Incidents[]) {
    this._incidents$.next(incident);
  }

  addRespondents(data: RespondentData[]) {
    let requestBody = {
      incidents: data,
    };

    return this.http.post<ResponseData<null>>(
      this.url$ + 'add_respondents.php',
      requestBody
    );
  }

  updateIncidentStatus(id: number, status: number) {
    let form = new FormData();
    form.append('id', id.toString());
    form.append('status', status.toString());
    return this.http.post<ResponseData<null>>(
      this.url$ + 'update_incident_status.php',
      form
    );
  }

  get incidents$() {
    return this._incidents$.asObservable();
  }
  get total$() {
    return this._total$.asObservable();
  }
  get loading$() {
    return this._loading$.asObservable();
  }
  get page() {
    return this._state.page;
  }
  get pageSize() {
    return this._state.pageSize;
  }
  get searchTerm() {
    return this._state.searchTerm;
  }

  set page(page: number) {
    this._set({ page });
  }
  set pageSize(pageSize: number) {
    this._set({ pageSize });
  }
  set searchTerm(searchTerm: string) {
    this._set({ searchTerm });
  }
  set sortColumn(sortColumn: SortColumn) {
    this._set({ sortColumn });
  }
  set sortDirection(sortDirection: SortDirection) {
    this._set({ sortDirection });
  }

  private _set(patch: Partial<State>) {
    Object.assign(this._state, patch);
    this._search$.next();
  }

  private _search(): Observable<SearchResult> {
    const { sortColumn, sortDirection, pageSize, page, searchTerm } =
      this._state;
    let countries = sort(this.ALL_INCIDENTS, sortColumn, sortDirection);

    countries = countries.filter((country) => matches(country, searchTerm));
    const total = countries.length;

    countries = countries.slice(
      (page - 1) * pageSize,
      (page - 1) * pageSize + pageSize
    );
    return of({ countries, total });
  }
}
