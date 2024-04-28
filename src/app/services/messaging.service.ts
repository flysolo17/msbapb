import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class MessagingService {
  private apiUrl = 'https://semaphore.co/api/v4/messages';
  constructor(private httpClient: HttpClient) {}

  sendMessage(apiKey: string, numbers: string[], message: string) {
    const params = {
      apikey: apiKey,
      number: numbers.join(','),
      message: message,
    };

    const headers = new HttpHeaders({
      'Content-Type': 'application/x-www-form-urlencoded',
    });

    return this.httpClient.post(this.apiUrl, null, {
      headers: headers,
      params: params,
    });
  }
}
