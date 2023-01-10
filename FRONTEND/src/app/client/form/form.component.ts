import { Component } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Client } from 'src/app/core/model/client';
import { ClientService } from '../../service/client/client.service';

@Component({
  selector: 'app-component-form',
  templateUrl: './form.component.html',
  styleUrls: ['./form.component.css']
})
export class FormComponent {

  constructor(private clientService: ClientService) { }


  ngLastname : string = "";
  ngFirstname : string = "";
  ngZipCode : string = "";
  ngTel : string = "";
  ngEmail : string = "";
  ngGender : string = "";
  ngLogin : string = "";
  ngPassword : string = "";
  ngPasswordCheck : string = "";

  showSummary = false;


  clientForm = new FormGroup({
    lastname: new FormControl('', [Validators.required, Validators.minLength(2)]),
    firstname: new FormControl('', [Validators.required, Validators.minLength(2)]),
    zipcode: new FormControl('', [Validators.required, Validators.minLength(5)]),
    tel: new FormControl('', [Validators.required, Validators.minLength(10)]),
    email: new FormControl('', [Validators.required, Validators.email]),
    gender : new FormControl('', [Validators.required]),
    login: new FormControl('', [Validators.required, Validators.minLength(2)]),
    password: new FormControl('', [Validators.required, Validators.minLength(2)]),
    passwordCheck: new FormControl('', [Validators.required, Validators.minLength(2)])
  });


  clicChange (val : boolean) {
    this.showSummary = val
  }

  client: Client | undefined ;

  // create object Client
  createClient() {
    this.client = new Client(0, this.clientForm.value.lastname!, this.clientForm.value.firstname!, this.clientForm.value.zipcode!,
      this.clientForm.value.tel!, this.clientForm.value.email!, this.clientForm.value.gender!, this.clientForm.value.login!, this.clientForm.value.password!);
      console.log(this.client);


    this.clientService.postNewClient(this.client).subscribe();
  }

}
