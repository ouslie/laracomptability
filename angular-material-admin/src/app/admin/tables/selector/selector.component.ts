import { Component, OnInit } from '@angular/core';
// import { BaseService } from '../data.service';


interface Food {
  value: string;
  viewValue: string;
}

@Component({
  selector: 'app-bases-selector',
  templateUrl: './selector.component.html',
  styleUrls: ['./selector.component.scss']
})

export class SelectorComponent implements OnInit {
  foods: Food[] = [
    { value: 'steak-0', viewValue: 'Steak' },
    { value: 'pizza-1', viewValue: 'Pizza' },
    { value: 'tacos-2', viewValue: 'Tacos' }
  ];
  // constructor(private readonly dataService: BaseService) {}
    ngOnInit() {
    }

}
