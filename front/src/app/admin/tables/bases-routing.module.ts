import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { BasesComponent } from './bases/bases.component';

const routes: Routes = [
  {
    path: '',
    component: BasesComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class BasesRoutingModule {}
