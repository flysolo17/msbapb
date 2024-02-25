import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PnpMainComponent } from './pnp-main.component';

describe('PnpMainComponent', () => {
  let component: PnpMainComponent;
  let fixture: ComponentFixture<PnpMainComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PnpMainComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PnpMainComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
