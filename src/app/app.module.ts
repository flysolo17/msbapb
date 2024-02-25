import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { CommonModule } from '@angular/common';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { HttpClientModule } from '@angular/common/http';
import { ToastrModule } from 'ngx-toastr';
import { AuthModule } from './auth/auth.module';
import { PnpModule } from './pnp/pnp.module';
import { BfpModule } from './bfp/bfp.module';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { DashboardComponent } from './shared/dashboard/dashboard.component';
import { IncidentComponent } from './shared/incident/incident.component';
import { PersonelsComponent } from './shared/personels/personels.component';
import { NewsComponent } from './shared/news/news.component';
import { AccountComponent } from './shared/account/account.component';
import { NgbdSortableHeader } from './services/sortable.directive';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { CreatePersonelComponent } from './dialogs/create-personel/create-personel.component';
import { LoginComponent } from './dialogs/login/login.component';

@NgModule({
  declarations: [
    AppComponent,
    DashboardComponent,
    IncidentComponent,
    PersonelsComponent,
    NewsComponent,
    AccountComponent,
    CreatePersonelComponent,
    LoginComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    CommonModule,
    HttpClientModule,
    AuthModule,
    NgbdSortableHeader,
    PnpModule,
    BfpModule,
    FormsModule,
    BrowserAnimationsModule,
    ReactiveFormsModule,
    ToastrModule.forRoot(),
    FontAwesomeModule,
  ],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
