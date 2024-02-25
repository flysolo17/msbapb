import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HomeComponent } from './home/home.component';
import { MainComponent } from './main/main.component';
import { AboutComponent } from './about/about.component';
import { TeamComponent } from './team/team.component';
import { RouterModule } from '@angular/router';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
@NgModule({
  declarations: [HomeComponent, MainComponent, AboutComponent, TeamComponent],
  imports: [CommonModule, RouterModule, NgbModule],
  exports: [MainComponent],
  bootstrap: [MainComponent],
})
export class AuthModule {}
