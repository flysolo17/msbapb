import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BfpMainComponent } from './bfp-main/bfp-main.component';
import { BfpRoutingModule } from './bfp-routing.module';
import { NgbdSortableHeader } from '../services/sortable.directive';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

@NgModule({
  declarations: [BfpMainComponent],
  imports: [CommonModule, BfpRoutingModule, NgbdSortableHeader, NgbModule],
})
export class BfpModule {}
