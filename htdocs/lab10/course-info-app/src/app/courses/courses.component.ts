import { Component } from '@angular/core';

import { FormsModule } from '@angular/forms'; 
import { CommonModule, NgFor } from '@angular/common'; // Also needed for *ngIf, *ngFor


import { Course } from '../course';
import { COURSES } from '../test-Course';
import { CourseDetailComponent } from '../course-detail/course-detail.component';


@Component({
  selector: 'app-courses',
  imports: [CommonModule, FormsModule,NgFor,CourseDetailComponent],
  templateUrl: './courses.component.html',
  styleUrl: './courses.component.css'
})
export class CoursesComponent {
  
  course: Course = {
    course_id: 1,
    course_title: "webdev",
    semester: 1,
    lecturer: "nathan",
    period: "wednesday 4-6"
  };
  

  courses = COURSES;


  selectedCourse?: Course;

  onSelect(course: Course) : void{
    this.selectedCourse = course;
  }
}
