import { Component } from '@angular/core';
import * as echarts from 'echarts';
import { Administrator } from 'src/app/models/Administrator';
import { Barangay } from 'src/app/models/Barangay';
import { Incidents } from 'src/app/models/Incidents';
import { Personels } from 'src/app/models/Personels';
import { AuthService } from 'src/app/services/auth.service';
import { BarangayService } from 'src/app/services/barangay.service';
import { IncidentsService } from 'src/app/services/incidents.service';
import { PersonelsService } from 'src/app/services/personels.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css'],
})
export class DashboardComponent {
  $users: Administrator | null = null;
  $personels: Personels[] = [];
  $barangays: Barangay[] = [];

  $incidents: Incidents[] = [];
  constructor(
    private authService: AuthService,
    private personelService: PersonelsService,
    private barangayService: BarangayService,
    private incidentService: IncidentsService
  ) {
    incidentService.getAllIncidents().subscribe((data) => {
      this.$incidents = data;
      this.renderIncidentsBarChart(this.$incidents);
    });
    authService.users$.subscribe((data) => {
      this.$users = data;
    });
    personelService.getAllPersonels().subscribe((data) => {
      this.$personels = data;
    });
    barangayService.getAllBarangay().subscribe((data) => {
      this.$barangays = data.data;
    });
  }

  get countBFP(): number {
    return this.$personels.filter((e) => e.type == 'BFP').length;
  }
  get countPNP(): number {
    return this.$personels.filter((e) => e.type == 'PNP').length;
  }
  renderIncidentsBarChart(incidents: Incidents[]): void {
    const chartElement = document.getElementById('incidents');

    if (!chartElement) {
      console.log('Incidents not found.');
      return;
    }

    const chart = echarts.init(chartElement);

    // Group incidents by month
    const groupedIncidents: { [month: number]: number } = {};

    incidents.forEach((incident) => {
      const incidentDate = new Date(incident.incident_date);
      const month = incidentDate.getMonth(); // Get the month index (0-11)
      if (!groupedIncidents[month]) {
        groupedIncidents[month] = 0;
      }
      groupedIncidents[month]++;
    });

    // Extract month names and incident counts
    const months = [
      'Jan',
      'Feb',
      'Mar',
      'Apr',
      'May',
      'Jun',
      'Jul',
      'Aug',
      'Sep',
      'Oct',
      'Nov',
      'Dec',
    ];
    const incidentCounts = Object.values(groupedIncidents);

    const option = {
      title: {
        text: 'Incident Reports by 2024',
        subtext: '',
        left: 'left',
      },
      xAxis: {
        type: 'category',
        data: months,
      },
      yAxis: {
        type: 'value',
      },
      series: [
        {
          name: 'Incidents',
          type: 'bar',
          data: incidentCounts,
          itemStyle: {
            borderRadius: 10,
            borderColor: '#fff',
            borderWidth: 2,
          },
          label: {
            show: true,
            position: 'top',
            formatter: '{c}',
          },
          emphasis: {
            itemStyle: {
              shadowBlur: 10,
              shadowOffsetX: 0,
              shadowColor: 'rgba(0, 0, 0, 0.5)',
            },
          },
        },
      ],
    };

    chart.setOption(option);
  }
}
