import { Component, OnDestroy, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Subscription } from 'rxjs';
import { Administrator } from 'src/app/models/Administrator';
import { AuthService } from 'src/app/services/auth.service';
import { IncidentsService } from 'src/app/services/incidents.service';
import { PersonelsService } from 'src/app/services/personels.service';

@Component({
  selector: 'app-pnp-main',
  templateUrl: './pnp-main.component.html',
  styleUrls: ['./pnp-main.component.css'],
})
export class PnpMainComponent implements OnDestroy, OnInit {
  links = [
    { title: 'Dashboard', fragment: 'dashboard', icon: 'fa-solid fa-house' },
    { title: 'News', fragment: 'news', icon: 'fa-solid fa-newspaper' },
    {
      title: 'Barangays ',
      fragment: 'barangays',
      icon: 'fa-solid fa-building',
    },
    { title: 'Incidents', fragment: 'incidents', icon: 'fa-solid fa-folder' },
    {
      title: 'Personels',
      fragment: 'personels',
      icon: 'fa-solid fa-user-group',
    },
  ];
  administrator$: Administrator | null = null;
  private subcription: Subscription;
  private personelSubcription: Subscription;
  constructor(
    public route: ActivatedRoute,
    private router: Router,

    private authService: AuthService,
    private incidentService: IncidentsService,
    private personelService: PersonelsService
  ) {
    authService.users$.subscribe((data) => {
      this.administrator$ = data;
    });
    this.subcription = new Subscription();
    this.personelSubcription = new Subscription();
  }
  ngOnInit(): void {
    this.subcription = this.incidentService
      .getAllIncidents()
      .subscribe((data) => {
        this.incidentService.ALL_INCIDENTS = data;
        this.incidentService.setIncidents(data);
      });
    this.personelSubcription = this.personelService
      .getAllPersonels()
      .subscribe((data) => {
        let userType = this.administrator$?.type === 2 ? 'PNP' : 'BFP';
        this.personelService.setPersonels(
          data.filter((e) => e.type === userType)
        );

        console.log(data);
      });
  }
  ngOnDestroy(): void {
    this.subcription.unsubscribe();
    this.personelSubcription.unsubscribe();
  }

  logout() {
    this.router.navigate(['/auth']);
    this.authService.logout();
  }
}
