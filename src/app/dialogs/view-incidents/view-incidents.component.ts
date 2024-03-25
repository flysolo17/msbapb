import { Component, Input, inject } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Incidents } from 'src/app/models/Incidents';

@Component({
  selector: 'app-view-incidents',
  templateUrl: './view-incidents.component.html',
  styleUrls: ['./view-incidents.component.css'],
})
export class ViewIncidentsComponent {
  activeModal = inject(NgbActiveModal);

  @Input('incident') incident!: Incidents;
  constructor() {}
}
