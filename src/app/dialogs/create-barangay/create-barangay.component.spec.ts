import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CreateBarangayComponent } from './create-barangay.component';

describe('CreateBarangayComponent', () => {
  let component: CreateBarangayComponent;
  let fixture: ComponentFixture<CreateBarangayComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CreateBarangayComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CreateBarangayComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
