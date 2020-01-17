import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment';

@Injectable()
export class LoginService {

  constructor(private http:HttpClient) { }


  login(data) {
    return this.http.post(`${environment.apiUrl}/api/login`, data.value);
  }

}
