import { Observable } from 'rxjs/Observable';
import { Location } from '@angular/common';
import { Injectable } from '@angular/core';
import { HttpInterceptor } from '@angular/common/http';
import { HttpRequest } from '@angular/common/http';
import { HttpHandler } from '@angular/common/http';
import { HttpEvent } from '@angular/common/http';
import { TokenService } from './token.service';
import { HttpHeaders } from '@angular/common/http';
import 'rxjs/add/observable/fromPromise';

@Injectable()
export class HttpService implements HttpInterceptor {
  constructor(private Token: TokenService) {
  }

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    console.log('ici');
    return Observable.fromPromise(this.handleAccess(request, next));
  }

  private async handleAccess(request: HttpRequest<any>, next: HttpHandler):
      Promise<HttpEvent<any>> {
        console.log('ici2');

    const token = await this.Token.get();
    let changedRequest = request;
    // HttpHeader object immutable - copy values
    const headerSettings: {[name: string]: string | string[]; } = {};

    for (const key of request.headers.keys()) {
      headerSettings[key] = request.headers.getAll(key);
    }
    if (token) {
      headerSettings['Authorization'] = 'Bearer ' + token;
    }
    headerSettings['Content-Type'] = 'application/json';
    const newHeader = new HttpHeaders(headerSettings);

    changedRequest = request.clone({
      headers: newHeader});
    return next.handle(changedRequest).toPromise();
  }

}
