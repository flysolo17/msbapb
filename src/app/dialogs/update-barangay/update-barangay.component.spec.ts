import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UpdateBarangayComponent } from './update-barangay.component';

describe('UpdateBarangayComponent', () => {
  let component: UpdateBarangayComponent;
  let fixture: ComponentFixture<UpdateBarangayComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ UpdateBarangayComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(UpdateBarangayComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
