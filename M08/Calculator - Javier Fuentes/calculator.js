/**
 * This is my calculator application created with JS
 * @file The only and core file of the Calculator Application
 * @author Javier Fuentes
 * @version 1.0 - First and definitive version of the Calculator 
 * @copyright Javier Fuentes 2021
 */

/**
 * Set or unset it to toggle the console logs
 * @global
 * @type {boolean}
 */
var debug = false;

/**
 * Calculator Operations
 * @public
 * @class
 * @classdesc This class contains the functions of all operations of the calculator
 */
class Operations{
    /**
     * Returns X plus Z
     * @function
     * @public
     * @param {integer} x - First number of the operation
     * @param {integer} z - Second number of the operation
     * @returns {integer}
     */
    Sum(x,z){
        if(debug){
            console.log("Sum operation...")
            console.log("Sum: "+x+" + "+z+" = "+(x+z))
        }
        return x+z
    }
    /**
     * Returns X minus Z
     * @function
     * @public
     * @param {integer} x - First number of the operation
     * @param {integer} z - Second number of the operation
     * @returns {integer}
     */
    Subtract(x,z){
        if(debug){
            console.log("Subtraction operation...")
            console.log("Subtraction: "+x+" - "+z+" = "+(x-z))
        }
        return x-z
    }
    /**
     * Returns X multiplicated by Z
     * @function
     * @public
     * @param {integer} x - First number of the operation
     * @param {integer} z - Second number of the operation
   * @returns {float|integer}
     */
    Multiplicate(x,z){
        if(debug){
            console.log("Multiplication operation...")
            console.log("MUltilpication: "+x+" * "+z+" = "+(x*z))
        }
        return x*z
    }
    /**
     * Returns X divided by Z
     * @function
     * @public
     * @param {integer} x - First number of the operation
     * @param {integer} z - Second number of the operation
     * @returns {float|integer}
     */
    Divide(x,z){
        if(debug){
            console.log("Division operation...")
            console.log("Division: "+x+" / "+z+" = "+(x/z))
        }
        return x/z
    }
}

/**
 * Calculator Screen Management
 * @public
 * @class
 * @classdesc This class contains functions that manage the calculator screen
 */
class CalculatorScreen{
    /** 
     * This variable inside CalculatorScreen class, contains the jQuery elements that matches with the calculator screen
     * @public
     * @type {jQueryObject}
    */
    screen = $('#screen');

    /**
     * Prints the param content on the calculator screen
     * @function
     * @public
     * @param {string|integer|float} content - Is the text/numbers that will be printed on screen 
     */
    Print(content){
        if(debug){
            console.log("Printing on screen...")
            console.log("Content to print: "+content)
        }
        this.screen.text(content);
    }

    /**
     * Clears the calculator screen
     * @function
     * @public
     */
    Clear(){
        if(debug){
            console.log("Cleaning screen...")
            console.log("Screen content: "+this.screen.text())
        }
        this.screen.text("0");
    }

    /**
     * Print an error in the calculator screen
     * @function
     * @param {string} result - It will be the error message to print on screen
     * @public
     */
    Error(result){
        if(debug){
            console.log("Something went wrong...")
            console.log("Screen content: "+result)
        }
        this.screen.text("ERROR");
    }
}

/**
 * Calculator Buttons Container
 * @public
 * @class
 * @classdesc This class contains two important Arrays that are the numbers and operations buttons
 */
class CalculatorButtons{
    /** 
     * This variable inside CalculatorButtons class, contains all the jQuery elements that matches with the number buttons
     * @public
     * @type {Array}
    */
    numbers = $(".s");

    /** 
     * This variable inside CalculatorButtons class, contains all the jQuery elements that matches with the operations buttons
     * @public
     * @type {Array}
    */
    functions = $(".c");
}

/**
 * Calculator System
 * @public
 * @class
 * @classdesc This class contains all the logic of the calculator and combine all classes of the app
 */
class CalculatorSystem{
    /** 
     * This variable inside CalculatorSystem class, contains an Operations class object
     * @public
     * @type {Operations}
    */
    operate = new Operations();

    /** 
     * This variable inside CalculatorSystem class, contains an CalculatorScreen class object
     * @public
     * @type {CalculatorScreen}
    */
    screen = new CalculatorScreen();

    /** 
     * This variable inside CalculatorSystem class, contains an CalculatorButtons class object
     * @public
     * @type {CalculatorButtons}
    */
    button = new CalculatorButtons();

    /** 
     * This variable inside CalculatorSystem class, contains the first number of the math opeartion of the calculator
     * @public
     * @type {string}
    */
    firstNumber = "0";

    /** 
     * This variable inside CalculatorSystem class, contains the operation between firstNumber and secondNumber variables
     * @public
     * @type {string}
    */
    operationSelect = "";

    /** 
     * This variable inside CalculatorSystem class, contains the second number of the math opeartion of the calculator
     * @public
     * @type {string}
    */
    secondNumber = "0";

    /**
     * In the constructor is all the logic of te calculator, it's like this because the application is simple and only a few lines of code are necessary
     * @constructor
     * @public
     */
    constructor(){
        let save = this;
        this.button.numbers.each(function(e){
            $(this).click(function(){
                if(save.operationSelect == ""){
                    if(save.firstNumber == 0){
                        save.firstNumber = $(this).text();
                    }else {
                        save.firstNumber += $(this).text();
                    }
                    if(debug){
                        console.log("Creating first number...")
                        console.log("Adding number: "+$(this).text())
                        console.log("Created number: "+save.firstNumber)
                    }
                    save.screen.Print(save.firstNumber);
                } else {
                    if(save.secondNumber == 0){
                        save.secondNumber = $(this).text();
                    }else {
                        save.secondNumber += $(this).text();
                    }
                    if(debug){
                        console.log("Creating second number...")
                        console.log("Adding number: "+$(this).text())
                        console.log("Created number: "+save.secondNumber)
                    }
                    save.screen.Print(save.firstNumber +" "+ save.operationSelect+" "+ save.secondNumber);
                }
            })
        })
        this.button.functions.each(function(e){
            $(this).click(function(){
                if($(this).text() == "C"){
                    save.screen.Clear();
                    save.firstNumber = "0";
                    save.operationSelect = "";
                    save.secondNumber = "0";
                } else if($(this).text() == "="){
                    if(save.operationSelect != "" && save.secondNumber != "0"){
                        if(save.operationSelect == "+"){
                            save.screen.Print(save.operate.Sum(parseInt(save.firstNumber),parseInt(save.secondNumber)))
                        } else if(save.operationSelect == "-"){
                            save.screen.Print(save.operate.Subtract(parseInt(save.firstNumber),parseInt(save.secondNumber)))
                        } else if(save.operationSelect == "*"){
                            save.screen.Print(save.operate.Multiplicate(parseInt(save.firstNumber),parseInt(save.secondNumber)))
                        } else if(save.operationSelect == "/"){
                            save.screen.Print(save.operate.Divide(parseInt(save.firstNumber),parseInt(save.secondNumber)))
                        }
                        save.firstNumber = "0";
                        save.operationSelect = "";
                        save.secondNumber = "0";
                    }
                } else {
                    if((save.operationSelect == "" && save.firstNumber != "0") || save.secondNumber != "0"){
                        if(debug){
                            console.log("Creating operation...")
                            console.log("Created operation: "+$(this).text())
                        }
                        save.operationSelect = $(this).text();
                        save.screen.Print(save.firstNumber +" "+ save.operationSelect+" "+save.secondNumber);
                    } 
                }
            })
        })
    }
}

/** 
 * This global variable contains a CalculatorSystem class object and it's the main core of the entire application
 * @global
 * @type {CalculatorSystem}
*/
calculator = new CalculatorSystem();
