import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import {
  FormBuilder,
  FormGroup,
  Validators,
  FormControl
} from '@angular/forms';
import { LoginService } from '../login.service';
import { TokenService } from '../../core/token.service';
import { AuthService } from '../../core/auth.service';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
  providers: [LoginService]
})

export class LoginComponent implements OnInit {
  public form: FormGroup;
  public error = null;

  constructor(
    private fb: FormBuilder,
    private router: Router,
    private LoginService: LoginService,
    private Token: TokenService,
    private Auth: AuthService
    ) {}

  ngOnInit() {
    this.form = this.fb.group({
      email: [null, Validators.compose([Validators.required])],
      password: [null, Validators.compose([Validators.required])]
    });
  }
  onSubmit() {
    console.log(this.form);
    this.LoginService.login(this.form).subscribe(
      data => this.handleResponse(data),
      error => this.handleError(error)
    )}

  handleResponse(data) {
    this.Token.handle(data.access_token);
    this.Auth.changeAuthStatus(true);
    this.router.navigateByUrl('/dashboard');
  }

  handleError(error) {
    this.error = error.error.error;
  }
    // onLogin() {
    // localStorage.setItem('isLoggedin', 'true');
    // this.router.navigate(['/dashboard']);

  // }

  
}
