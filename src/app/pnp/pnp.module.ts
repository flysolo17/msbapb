import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PnpMainComponent } from './pnp-main/pnp-main.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { RouterModule } from '@angular/router';
import { PnpRoutingModule } from './pnp-routing.module';
import { NgbdSortableHeader } from '../services/sortable.directive';

@NgModule({
  declarations: [PnpMainComponent],
  imports: [CommonModule, NgbModule, PnpRoutingModule, NgbdSortableHeader],
})
export class PnpModule {}
