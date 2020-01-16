import { Injectable } from '@angular/core';
import {
  CanActivate,
  ActivatedRouteSnapshot,
  RouterStateSnapshot,
  Router
} from '@angular/router';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})

export class AuthGuard implements CanActivate {

  constructor(private routes: Router) { }

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): boolean {
      console.log('ici');
    if (localStorage.getItem('access_token') != null) {
      console.log(localStorage.getItem('access_token'));
      return true;
    } else {
      console.log('tti');
      this.routes.navigate(['/login']);
      return false;
    }
  }

  logout(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot) {
    localStorage.clear();
      this.routes.navigate(['/login']);
    }

}
