function jsDateDiff(publishTime) {
    //dateSeperate = "-"       
    var d_minutes, d_hours, d_days;
    var timeNow = parseInt(new Date().getTime() / 1000);
    var d;
    d = timeNow - publishTime;
    d_days = parseInt(d / 86400);
    d_hours = parseInt(d / 3600);
    d_minutes = parseInt(d / 60);
    if (d_days > 0 && d_days < 4) {
        return d_days + "d ago";
    } else if (d_days <= 0 && d_hours > 0) {
        return d_hours + "h ago";
    } else if (d_hours <= 0 && d_minutes > 0) {
        return d_minutes + "m ago";
    } else {
        var s = new Date(publishTime * 1000);
        //s.getFullYear()+"年";       
        return s.getFullYear()+"/"+(s.getMonth() + 1) + "/" + s.getDate() + "";
    }
}