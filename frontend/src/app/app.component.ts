import { Component, OnInit } from '@angular/core';
import { DataService } from './service/data.service';
import { Faculty } from './faculty';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']  
})
export class AppComponent implements OnInit {
  faculties: Faculty[] = [];
  faculty: Faculty = new Faculty();

  constructor(private dataService: DataService) {}

  ngOnInit(): void {
    this.getFacultyData();
  }

  getFacultyData() {
    this.dataService.getData().subscribe(res => {
      this.faculties = res;
    });
  }

  insertData() {
    console.log(this.faculty); // Log the faculty data before submission
    this.dataService.insertData(this.faculty).subscribe(res => {
      console.log(res);
      this.getFacultyData(); // Refresh data
      this.faculty = new Faculty(); // Reset form
    });
  }
}
