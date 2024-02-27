import {
  Component,
  Input,
  OnInit,
  QueryList,
  ViewChildren,
  inject,
} from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Personels } from 'src/app/models/Personels';
import { RespondentData } from 'src/app/models/RespondentData';
import { PersonelsService } from 'src/app/services/personels.service';

@Component({
  selector: 'app-add-respondents',
  templateUrl: './add-respondents.component.html',
  styleUrls: ['./add-respondents.component.css'],
})
export class AddRespondentsComponent implements OnInit {
  activeModal = inject(NgbActiveModal);
  @ViewChildren('personelCheckbox') personelCheckboxes!: QueryList<any>;
  @Input('data') data: any;

  personels$: Personels[] = [];
  constructor(private personelService: PersonelsService) {}
  ngOnInit(): void {
    let respondents = this.data.respondents?.split(',');
    this.personelService.personels$.subscribe((data) => {
      data.forEach((personel) => {
        if (!respondents?.includes(personel.name)) {
          this.personels$.push(personel);
        }
      });
    });
  }

  getSelectedPersonels(): any[] {
    const selectedPersonels: any[] = [];
    this.personelCheckboxes.forEach((checkbox) => {
      if (checkbox.nativeElement.checked) {
        selectedPersonels.push(checkbox.nativeElement.value);
      }
    });
    return selectedPersonels;
  }

  submitPersonels() {
    let arr: RespondentData[] = [];
    this.getSelectedPersonels()?.map((data) => {
      if (data) {
        arr.push({
          incident_id: +this.data.incident_id ?? 0,
          respondent_id: +data,
        });
      }
    });

    this.activeModal.close(arr);
  }
}
