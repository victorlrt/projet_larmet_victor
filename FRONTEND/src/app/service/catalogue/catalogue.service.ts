import { Injectable } from '@angular/core';
import { distinct, Observable, of } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Mushroom } from '../../core/model/mushroom';
import { map } from 'rxjs/internal/operators/map';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class CatalogueService {

  constructor(private http: HttpClient) { }
  env = environment;
  apiUrl: string = environment.api;

  listProducts: Mushroom[] = [];

  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json'
    })
  };

  getAll(): Observable<Mushroom[]> {
    console.log("get all");
    return this.http.get<Mushroom[]>(this.apiUrl+"catalogue");
  }

  get(mushroom: Mushroom): Observable<Mushroom[]> {
    console.log("get specific");
    return this.http.get<Mushroom[]>(this.apiUrl+"catalogue/"+mushroom.id);
  }

  getAllDistinctTypeToxicity(): Observable<String[]> {
    return this.http.get<Mushroom[]>(this.apiUrl+"catalogue").pipe(map(
      (listProducts: Mushroom[]) => listProducts.map(
        (mushroom: Mushroom) => mushroom.toxicity).filter(
          (value, index, self) => self.indexOf(value) === index)));
  }

  post(Mushroom: Mushroom): Observable<Mushroom> {
    console.log("post");
    return this.http.post<Mushroom>(this.apiUrl+"catalogue", Mushroom, this.httpOptions);
  }

  put(Mushroom: Mushroom): Observable<Mushroom> {
    console.log("put");
    return this.http.put<Mushroom>(this.apiUrl+"catalogue/"+Mushroom.id, Mushroom, this.httpOptions);
  }

  delete(Mushroom: Mushroom): Observable<Mushroom> {
    console.log("delete");
    return this.http.delete<Mushroom>(this.apiUrl+"catalogue/"+Mushroom.id);
  }

  search(search: string): Observable<Mushroom[]> {
    if(search === ''){
      return this.getAll();
    }
    return this.http.get<Mushroom[]>(this.apiUrl+"catalogue/"+search, this.httpOptions)
  }


}
