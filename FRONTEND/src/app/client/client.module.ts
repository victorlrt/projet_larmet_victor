import { CommonModule } from '@angular/common';
import { FormComponent } from './form/form.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { CheckFormStringDirective } from '../core/directive/directive-string/check-form-string.directive';
import { CheckFormNumberDirective } from '../core/directive/directive-number/check-form-number.directive';
import { PipeFormatTelPipe } from '../core/pipe/pipe-format-tel.pipe';
import { CheckFormEMailDirective } from '../core/directive/directive-email/check-form-email.directive';
import { RouterModule, Routes } from '@angular/router';
import { SummaryComponent } from './summary/summary.component';

const clientRoutes: Routes = [
  {path: '', component: FormComponent}

];

@NgModule({
  declarations: [
    FormComponent,
    SummaryComponent,
    CheckFormStringDirective,
    CheckFormNumberDirective,
    PipeFormatTelPipe,
    CheckFormEMailDirective
  ],
  imports: [
    CommonModule,
    FormsModule,
    HttpClientModule,
    ReactiveFormsModule,
    RouterModule.forChild(clientRoutes),

  ]
})
export class ClientModule { }
