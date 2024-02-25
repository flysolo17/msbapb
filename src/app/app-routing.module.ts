import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BfpMainComponent } from './bfp/bfp-main/bfp-main.component';
import { PnpMainComponent } from './pnp/pnp-main/pnp-main.component';
import { AuthModule } from './auth/auth.module';
import { PnpModule } from './pnp/pnp.module';
import { BfpModule } from './bfp/bfp.module';
import { AuthRoutingModule } from './auth/auth-routing.module';
import { PnpRoutingModule } from './pnp/pnp-routing.module';
import { BfpRoutingModule } from './bfp/bfp-routing.module';
import { MainComponent } from './auth/main/main.component';

const routes: Routes = [
  { path: '', redirectTo: '/auth', pathMatch: 'full' },
  {
    path: 'auth',
    component: MainComponent,
    loadChildren: () =>
      import('./auth/auth-routing.module').then((m) => m.AuthRoutingModule),
  },
  {
    path: 'pnp',
    component: PnpMainComponent,
    loadChildren: () =>
      import('./pnp/pnp-routing.module').then((m) => m.PnpRoutingModule),
  },
  {
    path: 'bfp',
    component: BfpMainComponent,
    loadChildren: () =>
      import('./bfp/bfp-routing.module').then((m) => m.BfpRoutingModule),
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
