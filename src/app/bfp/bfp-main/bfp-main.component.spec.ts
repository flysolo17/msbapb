import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BfpMainComponent } from './bfp-main.component';

describe('BfpMainComponent', () => {
  let component: BfpMainComponent;
  let fixture: ComponentFixture<BfpMainComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BfpMainComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(BfpMainComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
