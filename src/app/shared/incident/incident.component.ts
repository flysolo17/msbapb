import { Component, QueryList, ViewChildren, inject } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { Observable, Subscription } from 'rxjs';
import { AddRespondentsComponent } from 'src/app/dialogs/add-respondents/add-respondents.component';
import { ViewIncidentsComponent } from 'src/app/dialogs/view-incidents/view-incidents.component';
import { Administrator } from 'src/app/models/Administrator';
import { Incidents } from 'src/app/models/Incidents';
import { RespondentData } from 'src/app/models/RespondentData';
import { AuthService } from 'src/app/services/auth.service';
import { IncidentsService } from 'src/app/services/incidents.service';
import { PrintingService } from 'src/app/services/printing.service';
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
  private modalService$ = inject(NgbModal);
  administrator$: Administrator | null = null;
  @ViewChildren(NgbdSortableHeader) headers: QueryList<NgbdSortableHeader>;
  constructor(
    private authService: AuthService,
    public incidentService: IncidentsService,
    private toastr: ToastrService,
    private printing: PrintingService
  ) {
    authService.users$.subscribe((data) => {
      this.administrator$ = data;
    });
    this.headers = new QueryList<NgbdSortableHeader>();
    this.incidents$ = incidentService.incidents$;
    this.total$ = incidentService.total$;
    this.refresh();
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

  addRespondents(incident_id: number, currentRespondents: string | null) {
    let modal = this.modalService$.open(AddRespondentsComponent);
    modal.componentInstance.data = {
      incident_id: incident_id,
      respondents: currentRespondents,
    };
    modal.result.then((data) => {
      if (data.length === 0) {
        this.toastr.error('No respondent selected');
        return;
      }
      this.saveSelectedRespondents(data);
    });
  }

  saveSelectedRespondents(respodents: RespondentData[]) {
    this.incidentService.addRespondents(respodents).subscribe({
      next: (value) => {
        if (value.status) {
          this.toastr.show(value.message);
        } else {
          this.toastr.error(value.message);
        }
      },
      error: (err) => {
        this.toastr.error(err.toString());
      },
      complete: () => this.refresh(),
    });
  }
  updateStatus(id: number, status: number) {
    this.incidentService.updateIncidentStatus(id, status).subscribe({
      next: (value) => {
        if (value.status) {
          this.toastr.success(value.message);
        } else {
          this.toastr.error(value.message);
        }
      },
      error: (err) => {
        this.toastr.error(err.toString());
      },
      complete: () => this.refresh(),
    });
  }

  convertToNumber(status: string): number {
    switch (status.toUpperCase()) {
      case 'OPEN':
        return 1;
      case 'UNDER INVESTIGATION':
        return 2;
      case 'CLOSED':
        return 3;
      default:
        return 1; // Default value if status is not recognized
    }
  }
  async print() {
    let subscription: Subscription | undefined;

    try {
      subscription = this.incidents$.subscribe((incidents: Incidents[]) => {
        if (this.administrator$) {
          this.printing.downloadPDF(this.administrator$.name ?? '', incidents);
        } else {
          // Handle case when administrator$ is undefined
          throw new Error('Administrator not found.');
        }
      });
    } catch (e) {
      if (e instanceof Error) {
        this.toastr.error(e.message.toString());
      } else {
        // Handle case when 'e' is not an instance of Error
        this.toastr.error('An unknown error occurred.');
      }
    } finally {
      if (subscription) {
        subscription.unsubscribe();
      }
    }
  }

  viewIncident(incident: Incidents) {
    const modal = this.modalService$.open(ViewIncidentsComponent, {
      size: 'lg',
    });
    modal.componentInstance.incident = incident;
  }
}
