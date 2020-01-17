import { Component, OnInit, ViewChild, AfterViewInit } from '@angular/core';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { BaseService, Base } from '../services/data.service';




@Component({
  selector: 'app-bases',
  templateUrl: './bases.component.html',
  styleUrls: ['./bases.component.scss']
})

export class BasesComponent implements OnInit {
  displayedColumns: string[] = ['id', 'name'];
  dataSource;
  base;
  bases: Base[];

  @ViewChild(MatPaginator, { static: true }) paginator: MatPaginator;
  @ViewChild(MatSort, { static: true }) sort: MatSort;

  constructor(private readonly dataService: BaseService) {}
    ngOnInit() {
      this.dataService.get()
        .subscribe((bases: Base[]) => {
          this.bases = bases;
          this.dataSource = new MatTableDataSource(bases);
          this.dataSource.paginator = this.paginator;
          this.dataSource.sort = this.sort;
        });
    }
}
