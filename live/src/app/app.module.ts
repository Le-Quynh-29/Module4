import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { TimelinesComponent } from './timelines/timelines.component';

@NgModule({
  declarations: [
    TimelinesComponent
],
imports: [
    BrowserModule,
    AppRoutingModule
],
bootstrap: [AppComponent]
})
export class AppModule { }
