select ot.day, ot.quarter, ot.team, dt.nickname, ot.play from
(
  select t.city as city, t.nickname as team, p.description as play, p.defense_team as defense, p.game_date as day, p.quarter as quarter from 
  ( 
    select * from teams
    where city like '%Dallas%' or nickname like '%Dallas%'
  ) t
  left outer join plays p
  on p.offense_team = t.team_name
) ot
right outer join
(
  select * from teams
  where city like '%Tennessee%' or nickname like '%Tennessee%'
) dt
on ot.defense = dt.team_name
where ot.play like '%PASS%';
