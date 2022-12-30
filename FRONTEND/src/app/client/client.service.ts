import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Client } from '../core/model/client';
import { environment } from "src/environments/environment";

@Injectable({
  providedIn: 'root'
})
export class ClientService {


  constructor(private http: HttpClient) {

  }


  apiUrl: string = environment.api;
  apiTarget: string = "client";
  clients : Client[] = [];


  getAllClients(): Observable<Client[]> {
    return this.http.get<Client[]>(this.apiUrl+"client");
  }

  postClient(client: Client): Observable<Client> {
    console.log("postClient");
    return this.http.post<Client>(this.apiUrl+this.apiTarget, client);
  }


}
