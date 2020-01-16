import { Injectable } from '@angular/core';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { RouteConfigLoadEnd } from '@angular/router';
import { unwrapResolvedMetadata } from '@angular/compiler';
import { environment } from '../../environments/environment';

@Injectable()
export class LoginService {

  constructor(private http:HttpClient) { }


  login(data) {
    return this.http.post(`${environment.apiUrl}/api/login`, data.value);
  }

}
