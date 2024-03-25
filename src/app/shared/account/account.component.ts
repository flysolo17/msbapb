import { Component, inject } from '@angular/core';
import { Router } from '@angular/router';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { take } from 'rxjs';
import { AddLocationsComponent } from 'src/app/dialogs/add-locations/add-locations.component';
import { EditProfileComponent } from 'src/app/dialogs/edit-profile/edit-profile.component';
import { Administrator } from 'src/app/models/Administrator';
import { Locations } from 'src/app/models/Locatiions';
import { AuthService } from 'src/app/services/auth.service';
import { LocationsService } from 'src/app/services/locations.service';

@Component({
  selector: 'app-account',
  templateUrl: './account.component.html',
  styleUrls: ['./account.component.css'],
})
export class AccountComponent {
  administrator$: Administrator | null = null;
  locations$: Locations[] = [];

  private modalService$ = inject(NgbModal);
  constructor(
    private authService: AuthService,
    private router: Router,
    private locationsService: LocationsService,
    private toastr: ToastrService
  ) {
    authService.users$.subscribe((data) => {
      this.administrator$ = data;
      this.getAllLocations(data?.type === 1 ? 'BFP' : 'PNP');
    });
  }
  getAllLocations(type: string) {
    this.locationsService.getAllLocations().subscribe((data) => {
      this.locations$ = data.data.filter((e) => e.type === type);
    });
  }
  logout() {
    this.authService.logout();
    this.router.navigate(['/auth']);
  }

  addLocation() {
    const modal = this.modalService$.open(AddLocationsComponent);
    modal.result.then((data) => {
      if (data === true) {
        this.getAllLocations(this.administrator$?.type === 1 ? 'BFP' : 'PNP');
      } else {
        this.toastr.warning('Add location cancelled');
      }
    });
  }

  editProfile() {
    const modal = this.modalService$.open(EditProfileComponent);
    modal.componentInstance.administrator = this.administrator$;
  }
  deleteLocation(id: number) {
    this.locationsService.deleteLocation(id).subscribe({
      next: (data) => {
        if (data.status) {
          this.toastr.success(data.message);
          this.getAllLocations(this.administrator$?.type === 1 ? 'BFP' : 'PNP');
        } else {
          this.toastr.error(data.message);
        }
      },
      error: (err) => this.toastr.error(err['message'].toString()),
    });
  }
}
