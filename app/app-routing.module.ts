import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { TestProfileComponent } from './profile/img/profile.component';
const routes: Routes = [
  {
    path: 'test-profile', component: TestProfileComponent
}];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
