# LGH Technical Practical v12

This is a base laravel 12 project and requires PHP 8.2 minimum to run correctly (We recommend using PHP 8.4).

This is a fresh Laravel installation with only a custom install command and database seeder added. Everything else is yours to build.

---

- Before doing anything please fork this repository.
- Make commits and pushes as often as you feel the need to.
- Complete as much as you can.
- Once you feel you have completed as much of the requirements as you feel the need to, email the hiring manager with a link to your repository.
---

## Setup

- Run Composer install
```
composer install
```
- The project is set to use sqlite, but change to mysql if you prefer
- Copy the env.example file and rename to .env and apply your database configuration as/if needed.
- Create a new APP KEY using the below artisan command:
```
  php artisan key:generate
```
- Add your database credentials to the .env file if not using sqlite
- Run the following command
```
php artisan lgh:install
```

---

## Database structure

#### onrent

- Contains header records with daily totals (contracts, quotes, weekly_value) for a single LGH company over the course of 30 days.
- hasMany relationship to onrent_lines via **onrent_id**

#### onrent_lines

- Contains individual contract line items with order_value amounts
- Many-to-one relationship to onrent via **onrent_id**

---

## Notes:

- Most of the internal applications we maintain use AlpineJs & Livewire.
- You may use vanilla JavaScript or Alpine JS / Livewire for frontend reactivity.
- You may use any other 3rd party packages, libraries and/or css/js frameworks of your choice to complete the task.
- Layouts, fonts, colour schemes if any, are your choice.
- No Models, Factories, Controllers or Components have been created. This has been left to your decision.
- No Routes have been defined.

## The Task

### Scenario

Recent events have resulted in order volumes falling below typical seasonal benchmarks. Management needs immediate visibility into business performance through key indicators including current contract levels, daily quote activity, and weekly hire values.

    Your task is to write a report which will help them make decisions required to keep the business afloat.

### Part 1: Generate Chart

Generate a mixed bar/line chart which clearly shows the following for the last 3 weeks:

#### Required:

- Daily contracts and quotes count (bar chart - one bar per day)
- The weekly hire value for each day (line chart)
- Show dates in dd/mm/YYYY format on the X axis;
- Show appropriate Y Axis for each bar/line of the chart.

#### Bonus:

- Calculate and show as a line, the moving average of weekly hire.

### Part 2: Generate tabular data

#### Required

- Generate a table under the chart showing the same data in tabular format.

#### Bonus

- Provide the ability to view the order lines for contracts (onrent_lines table) for each date in tabular format via a modal / popup.

### Part 3: Feature Request (Optional)

- Add a feature of your choice to the report that you feel would be beneficial to management.
