import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Faculty } from '../faculty';

@Injectable({
  providedIn: 'root'
})
export class DataService {

  private apiUrl = 'http://127.0.0.1:8000/api';

  constructor(private httpClient: HttpClient) { }

  getData(): Observable<Faculty[]> {
    return this.httpClient.get<Faculty[]>(`${this.apiUrl}/faculties`);
  }

  insertData(faculty: Faculty): Observable<Faculty> {
    return this.httpClient.post<Faculty>(`${this.apiUrl}/addFaculty`, faculty);
  }
}
