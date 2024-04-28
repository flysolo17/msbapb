import {
  Component,
  OnInit,
  QueryList,
  ViewChildren,
  inject,
} from '@angular/core';
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
export class IncidentComponent implements OnInit {
  incidents$: Observable<Incidents[]>;
  total$: Observable<number>;
  private modalService$ = inject(NgbModal);
  administrator$: Administrator | null = null;

  latitude$: number = 0;
  longitude$: number = 0;
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
  ngOnInit(): void {}

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
  openGoogleMap(lat: number, lng: number): void {
    console.log(lat);
    console.log(lng);
    // Check if the Geolocation API is available
    if (navigator.geolocation) {
      // Request the current location
      navigator.geolocation.getCurrentPosition(
        (position) => {
          // Success callback: handle the position
          const currentLat = position.coords.latitude;
          const currentLng = position.coords.longitude;

          // Construct the Google Maps URL with the current location as origin and the specified destination
          const uri = `https://www.google.com/maps/dir/?api=1&origin=${currentLat},${currentLng}&destination=${lat},${lng}&travelmode=driving&dir_action=navigate`;

          // Open the constructed URL in a new tab
          window.open(uri, '_blank');
        },
        (error) => {
          // Error callback: handle the error
          console.error('Error getting location:', error);
          // You can handle the error, e.g., show an alert or provide a fallback action
        },
        {
          enableHighAccuracy: true, // Optional: request high accuracy
          timeout: 10000, // Optional: specify a timeout
          maximumAge: 0, // Optional: specify the maximum age of a cached position
        }
      );
    } else {
      // Geolocation API is not available
      console.error('Geolocation API is not available in this browser.');
      // You can handle the lack of geolocation support, e.g., show an alert or provide a fallback action
    }
  }

  // getCurrentLocation(): void {
  //   if (navigator.geolocation) {
  //     navigator.geolocation.getCurrentPosition(
  //       (position) => {
  //         const latitude = position.coords.latitude;
  //         const longitude = position.coords.longitude;
  //         this.latitude$ = latitude;
  //         this.longitude$ = longitude;
  //         console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);
  //       },
  //       (error) => {
  //         console.error('Error getting location:', error);
  //       },
  //       {
  //         enableHighAccuracy: true,
  //         timeout: 10000,
  //         maximumAge: 0,
  //       }
  //     );
  //   } else {
  //   }
  // }
}
