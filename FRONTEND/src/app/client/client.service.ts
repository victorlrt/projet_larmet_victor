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

  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json'
    })
  };


  apiUrl: string = environment.api;
  clients : Client[] = [];


  getAll(): Observable<Client[]> {
    console.log("get all");
    return this.http.get<Client[]>(this.apiUrl+"client");
  }

  get(client: Client): Observable<Client[]> {
    console.log("get specific");
    return this.http.get<Client[]>(this.apiUrl+"client/"+client.id);
  }

  postNewClient(client: Client): Observable<Client> {
    console.log("post");
    return this.http.post<Client>(this.apiUrl+"client", client);
  }

  put(client: Client): Observable<Client> {
    console.log("put");
    return this.http.put<Client>(this.apiUrl+"client/"+client.id, client, this.httpOptions);
  }

  delete(client: Client): Observable<Client> {
    console.log("delete");
    return this.http.delete<Client>(this.apiUrl+"client/"+client.id);
  }

}
