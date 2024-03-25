import { Component, inject } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { Administrator } from 'src/app/models/Administrator';
import { AuthService } from 'src/app/services/auth.service';
import { LocationsService } from 'src/app/services/locations.service';

@Component({
  selector: 'app-add-locations',
  templateUrl: './add-locations.component.html',
  styleUrls: ['./add-locations.component.css'],
})
export class AddLocationsComponent {
  activeModal = inject(NgbActiveModal);

  locationForm$: FormGroup;
  users$: Administrator | null = null;
  constructor(
    private fb: FormBuilder,
    private authSevice: AuthService,
    private locationsService: LocationsService,
    private toastr: ToastrService
  ) {
    authSevice.users$.subscribe((data) => {
      this.users$ = data;
    });
    this.locationForm$ = fb.group({
      name: ['', Validators.required],
      contact: ['', Validators.required],
      lat: ['', Validators.required],
      lang: ['', Validators.required],
    });
  }

  onSubmit() {
    if (this.locationForm$.valid) {
      let name: string = this.locationForm$.get('name')?.value ?? '';
      let contact: string = this.locationForm$.get('contact')?.value ?? '';
      let lat: number = this.locationForm$.get('lat')?.value ?? 0;
      let lang: number = this.locationForm$.get('lang')?.value ?? 0;
      this.locationsService
        .addLocations(name, contact, lat, lang, this.users$?.type ?? 1)
        .subscribe({
          next: (data) => {
            if (data.status) {
              this.toastr.success(data.message);
              this.activeModal.close(true);
            } else {
              this.toastr.error(data.message);
            }
          },
          error: (err) => {
            this.toastr.error(err['message'].toString());
          },
        });
    }
  }
}
