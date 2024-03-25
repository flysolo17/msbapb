import { Component, inject } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { CreateNewsComponent } from 'src/app/dialogs/create-news/create-news.component';
import { News } from 'src/app/models/News';
import { NewsService } from 'src/app/services/news.service';

@Component({
  selector: 'app-news',
  templateUrl: './news.component.html',
  styleUrls: ['./news.component.css'],
})
export class NewsComponent {
  news$: News[] = [];

  filteredNews$: News[] = [];
  searching: string = '';
  private modalService$ = inject(NgbModal);
  constructor(private newsService: NewsService, private toastr: ToastrService) {
    newsService.getAllNews().subscribe((data) => {
      this.news$ = data;
      this.filteredNews$ = data;
      console.log(this.news$);
    });
  }

  openLinkInNewTab(url: string): void {
    window.open(url, '_blank');
  }

  filterNews() {
    this.filteredNews$ = this.news$.filter((news) =>
      news.title.toLowerCase().includes(this.searching.toLowerCase())
    );
  }
  fetchNews() {
    this.newsService.getAllNews().subscribe((data) => {
      this.news$ = data;
      this.filteredNews$ = data;
      console.log(this.news$);
    });
  }

  createNews() {
    const modalRef = this.modalService$.open(CreateNewsComponent);
    modalRef.result.then((data) => {
      if (data === true) {
        this.fetchNews();
      } else {
        this.toastr.warning('Adding news cancelled');
      }
    });
  }

  deleteNews(id: number) {
    this.newsService.deleteNews(id).subscribe({
      next: (data) => {
        if (data.status) {
          this.toastr.success(data.message);
          this.fetchNews();
        } else {
          this.toastr.error(data.message);
        }
      },
      error: (err) => {
        this.toastr.error(err.message);
      },
    });
  }
}
