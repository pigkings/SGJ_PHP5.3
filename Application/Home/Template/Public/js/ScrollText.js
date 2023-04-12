function ScrollText(content,btnPrevious,btnNext,autoStart,timeout,isSmoothScroll)
{
    this.Speed = 5;
    this.Timeout = timeout;
	this.stopscroll =false;
	this.isSmoothScroll= isSmoothScroll;
    this.LineHeight = 20;
    this.NextButton = this.$(btnNext);
    this.PreviousButton = this.$(btnPrevious);
    this.ScrollContent = this.$(content);
    this.ScrollContent.innerHTML += this.ScrollContent.innerHTML;

	if(this.PreviousButton)

	{
		this.PreviousButton.onclick = this.GetFunction(this,"Previous"); 
		this.PreviousButton.onmouseover = this.GetFunction(this,"MouseOver");
		this.PreviousButton.onmouseout = this.GetFunction(this,"MouseOut");
	}
	if(this.NextButton){
		this.NextButton.onclick = this.GetFunction(this,"Next");
		this.NextButton.onmouseover = this.GetFunction(this,"MouseOver");
		this.NextButton.onmouseout = this.GetFunction(this,"MouseOut");
    }
    this.ScrollContent.onmouseover = this.GetFunction(this,"MouseOver");
    this.ScrollContent.onmouseout = this.GetFunction(this,"MouseOut");

    if(autoStart)
    {
        this.Start();
    }
}

ScrollText.prototype = {

	$:function(element)
	{
		return document.getElementById(element);
	},
	Previous:function()
	{
		this.stopscroll = true;
		this.Scroll("up");
	},
	Next:function()
	{
		this.stopscroll = true;
		this.Scroll("down");
	},
	Start:function()
	{
		if(this.isSmoothScroll)
		{
			this.AutoScrollTimer = setInterval(this.GetFunction(this,"SmoothScroll"), this.Timeout);
		}
		else
		{		
			this.AutoScrollTimer = setInterval(this.GetFunction(this,"AutoScroll"), this.Timeout);
		}
	},
	Stop:function()
	{
		clearTimeout(this.AutoScrollTimer);
		this.DelayTimerStop = 0;
	},
	MouseOver:function()
	{	
		this.stopscroll = true;
	},
	MouseOut:function()
	{
		this.stopscroll = false;
	},
	AutoScroll:function()
	{
		if(this.stopscroll) 
		{
			return;
		}
		this.ScrollContent.scrollTop++;
		if(parseInt(this.ScrollContent.scrollTop) % this.LineHeight != 0)
		{
			this.ScrollTimer = setTimeout(this.GetFunction(this,"AutoScroll"), this.Speed);
		}
		else
		{
			if(parseInt(this.ScrollContent.scrollTop) >= parseInt(this.ScrollContent.scrollHeight) / 2)
			{
				this.ScrollContent.scrollTop = 0;
			}
			clearTimeout(this.ScrollTimer);
			//this.AutoScrollTimer = setTimeout(this.GetFunction(this,"AutoScroll"), this.Timeout);
		}
	},
	SmoothScroll:function()
	{
		if(this.stopscroll) 
		{
			return;
		}
		this.ScrollContent.scrollTop++;
		if(parseInt(this.ScrollContent.scrollTop) >= parseInt(this.ScrollContent.scrollHeight) / 2)
		{
			this.ScrollContent.scrollTop = 0;
		}
	},
	Scroll:function(direction)
	{

		if(direction=="up")
		{
			this.ScrollContent.scrollTop--;
		}
		else
		{
			this.ScrollContent.scrollTop++;
		}
		if(parseInt(this.ScrollContent.scrollTop) >= parseInt(this.ScrollContent.scrollHeight) / 2)
		{
			this.ScrollContent.scrollTop = 0;
		}
		else if(parseInt(this.ScrollContent.scrollTop)<=0)
		{
			this.ScrollContent.scrollTop = parseInt(this.ScrollContent.scrollHeight) / 2;
		}
		
		if(parseInt(this.ScrollContent.scrollTop) % this.LineHeight != 0)
		{
			this.ScrollTimer = setTimeout(this.GetFunction(this,"Scroll",direction), this.Speed);
		}
	},
	GetFunction:function(variable,method,param)
	{
		return function()
		{
			variable[method](param);
		}
	}
}

function ignoreError() {
  return true;
}
window.onerror = ignoreError; 