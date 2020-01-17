import {
  BrowserModule,
  HAMMER_GESTURE_CONFIG
} from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { GestureConfig } from '@angular/material/core';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { FormsModule } from '@angular/forms';
import { HttpClientModule, HttpClient, HTTP_INTERCEPTORS } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { CoreModule } from './core/core.module';
import { SharedModule } from './shared/shared.module';

import { HttpService } from './core/http.service';

@NgModule({
  declarations: [AppComponent],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    AppRoutingModule,
    HttpClientModule,
    CoreModule,
    SharedModule,
    FormsModule,

  ],
  providers: [
    // { provide: HAMMER_GESTURE_CONFIG, useClass: GestureConfig },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: HttpService,
      multi: true
    }
  ],
  
  bootstrap: [AppComponent]

})
export class AppModule {}
