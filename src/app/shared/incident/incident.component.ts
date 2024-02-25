import { Component, QueryList, ViewChildren } from '@angular/core';
import { Observable } from 'rxjs';
import { Incidents } from 'src/app/models/Incidents';
import { AuthService } from 'src/app/services/auth.service';
import { IncidentsService } from 'src/app/services/incidents.service';
import {
  NgbdSortableHeader,
  SortEvent,
} from 'src/app/services/sortable.directive';

@Component({
  selector: 'app-incident',
  templateUrl: './incident.component.html',
  styleUrls: ['./incident.component.css'],
})
export class IncidentComponent {
  incidents$: Observable<Incidents[]>;
  total$: Observable<number>;

  @ViewChildren(NgbdSortableHeader) headers: QueryList<NgbdSortableHeader>;
  constructor(
    private authService: AuthService,
    public incidentService: IncidentsService
  ) {
    this.headers = new QueryList<NgbdSortableHeader>();
    this.incidents$ = incidentService.incidents$;
    this.total$ = incidentService.total$;
  }

  onSort({ column, direction }: SortEvent) {
    this.headers.forEach((header) => {
      if (header.sortable !== column) {
        header.direction = '';
      }
    });
    this.incidentService.sortColumn = column;
    this.incidentService.sortDirection = direction;
  }

  getSeverityColor(severity: string): string {
    switch (severity.toUpperCase()) {
      case 'LOW':
        return 'green';
      case 'MEDIUM':
        return 'yellow';
      case 'HIGH':
        return 'red';
      default:
        return 'black';
    }
  }
  refresh() {
    this.incidentService.getAllIncidents().subscribe((data) => {
      this.incidentService.setIncidents(data);
    });
  }
}
