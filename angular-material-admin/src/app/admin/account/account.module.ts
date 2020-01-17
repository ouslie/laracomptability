import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MatTableModule } from '@angular/material/table';
import { MatPaginatorModule } from '@angular/material/paginator';
import { MatSortModule } from '@angular/material/sort';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { MatCheckboxModule } from '@angular/material/checkbox';

import { AccountRoutingModule } from './account-routing.module';
import { TablesComponent } from './tables/tables.component';
import { BaseService } from './data.service';

@NgModule({
  imports: [
    CommonModule,
    AccountRoutingModule,
    MatTableModule,
    MatFormFieldModule,
    MatPaginatorModule,
    MatSortModule,
    MatInputModule,
    MatCheckboxModule
  ],
  declarations: [TablesComponent],
  providers: [BaseService]
})
export class AccountModule {}
