
import { environment } from '../../../../environments/environment';
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable()
export class BaseService {

  constructor(private http: HttpClient) {}

  get() {
    return this.http.get(`${environment.apiUrl}/api/bases`);
  }

}

export interface Base {
  name: string;
  id: number,
}