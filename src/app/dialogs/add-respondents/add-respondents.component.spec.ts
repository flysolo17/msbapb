import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AddRespondentsComponent } from './add-respondents.component';

describe('AddRespondentsComponent', () => {
  let component: AddRespondentsComponent;
  let fixture: ComponentFixture<AddRespondentsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AddRespondentsComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AddRespondentsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
