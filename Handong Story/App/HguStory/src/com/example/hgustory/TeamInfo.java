package com.example.hgustory;

public class TeamInfo {
	String teamYear;
	String teamProf;
	String teamID;
	
	public TeamInfo(){
		super();
	}
	public TeamInfo(String yr,String pr, String id){
		super();
		this.teamYear = yr;
		this.teamProf =pr;
		this.teamID = id;
	}
	public String getTeamYear() {
		return teamYear;
	}
	public void setTeamYear(String teamYear) {
		this.teamYear = teamYear;
	}
	public String getTeamProf() {
		return teamProf;
	}
	public void setTeamProf(String teamProf) {
		this.teamProf = teamProf;
	}
	public String getTeamID() {
		return teamID;
	}
	public void setTeamID(String teamID) {
		this.teamID = teamID;
	}
}
