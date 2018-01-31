import { Component, ContentChildren, QueryList, AfterContentInit } from '@angular/core';
import { TabComponent } from './tab.component';

@Component({
  selector: 'app-tabs',
  template: `
    <ul class="nav nav-tabs">
      <li *ngFor="let tab of tabs" (click)="selectTab(tab)" [class.active]="tab.active" [class.disabled]="tab.disabled">
        <a>{{tab.tabTitle}}</a>
      </li>
    </ul>
    <ng-content></ng-content>
  `,
  styles: ['a {cursor: pointer;}']
})
export class TabsComponent implements AfterContentInit {

  @ContentChildren(TabComponent) tabs: QueryList<TabComponent>;

  // contentChildren are set
  ngAfterContentInit() {
    // get all active tabs
    const activeTabs = this.tabs.filter((tab) => tab.active);

    // if there is no active tab set, activate the first
    if (activeTabs.length === 0) {
      this.selectTab(this.tabs.first);
    }
  }

  selectTab(tab: TabComponent) {
    // deactivate all tabs
    if (!tab.disabled) {
      // tslint:disable-next-line:no-shadowed-variable
      this.tabs.toArray().forEach(tab => tab.active = false);

      // activate the tab the user has clicked on.
      tab.active = true;
    }
  }

}
