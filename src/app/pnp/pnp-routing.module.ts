import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DashboardComponent } from '../shared/dashboard/dashboard.component';
import { IncidentComponent } from '../shared/incident/incident.component';
import { PersonelsComponent } from '../shared/personels/personels.component';
import { AccountComponent } from '../shared/account/account.component';
import { NewsComponent } from '../shared/news/news.component';
const routes: Routes = [
  { path: '', component: DashboardComponent },
  { path: 'dashboard', component: DashboardComponent },
  { path: 'incidents', component: IncidentComponent },
  { path: 'personels', component: PersonelsComponent },
  { path: 'news', component: NewsComponent },
  { path: 'accounts', component: AccountComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PnpRoutingModule {}
