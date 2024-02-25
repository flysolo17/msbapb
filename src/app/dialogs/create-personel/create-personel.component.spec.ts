import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CreatePersonelComponent } from './create-personel.component';

describe('CreatePersonelComponent', () => {
  let component: CreatePersonelComponent;
  let fixture: ComponentFixture<CreatePersonelComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CreatePersonelComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CreatePersonelComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
