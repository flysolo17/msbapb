import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PersonelsComponent } from './personels.component';

describe('PersonelsComponent', () => {
  let component: PersonelsComponent;
  let fixture: ComponentFixture<PersonelsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PersonelsComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PersonelsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
