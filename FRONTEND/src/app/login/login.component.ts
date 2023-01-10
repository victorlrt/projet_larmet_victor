import { Component, EventEmitter, Output } from '@angular/core';
import { LoginService } from '../login.service';
import { FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {

  constructor(private loginService : LoginService) { }

  loginForm: FormGroup = new FormGroup({
    pseudo: new FormControl('', [Validators.required]),
    password: new FormControl('')
  });

  isConnected = false

  @Output() login = new EventEmitter<string>();


  loginClient() {
    this.loginService.login(this.loginForm.value.pseudo, this.loginForm.value.password).subscribe(
      (data) => {
        this.isConnected = true;
        console.log('loginComponent login', data['login']);
        this.login.emit(data['login']);
      }
    );
  }
}
