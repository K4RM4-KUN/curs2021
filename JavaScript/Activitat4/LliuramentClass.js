// Constructor
var LliuramentClass = function(activity, author, buttons=true){
    // Private attributes / methods
    var exercises = [];

    function _renderButton(text, callback) {
        // Create HTML button
        var btn = document.createElement('button');
        btn.innerHTML = "Exercici " + text;
        btn.addEventListener("click", callback);
        // Create HTML div
        var btnDiv = document.createElement('div');
        btnDiv.style = "margin-bottom: 20px";
        btnDiv.appendChild(btn);
        document.body.appendChild(btnDiv);
    }
    
    // Public attributes / methods
    return {
        add: function(exercise, callback) {
            exercises.push({
                "exercise": exercise,
                "callback": callback,
            });
        },
        render: function(){
            // Render activity number and student name
            document.getElementById("activity").innerHTML = activity;
            document.getElementById("author").innerHTML = author;
            // Render buttons (including events)
            for (var i in exercises) {
                if (buttons) {
                    _renderButton(
                        exercises[i].exercise,
                        exercises[i].callback
                    );
                } else {
                    exercises[i].callback();
                }
            }			
        }
    };
};