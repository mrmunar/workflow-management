import { Component, Input } from '@angular/core';

@Component({
  selector: 'app-tab',
  styles: [`
    .pane{
      padding: 1em;
    }
  `],
  template: `
    <div [hidden]="!active" class="pane">
      <ng-content></ng-content>
    </div>
  `
})
export class TabComponent {
  @Input('tabTitle') tabTitle: string;
  @Input() active = false;
  @Input('disabled') disabled: false;
}
