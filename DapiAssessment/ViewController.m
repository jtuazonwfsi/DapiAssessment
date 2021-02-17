//
//  ViewController.m
//  DapiAssessment
//
//  Created by mina wefky on 17/02/2021.
//

#import "ViewController.h"

@interface ViewController ()

@end


//MARK:- URLs array
NSArray *urls;



@implementation ViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    // URLs array initialization
    urls = [NSArray arrayWithObjects:
            @"apple.com",
            @"spacex.com",
            @"dapi.co",
            @"facebook.com",
            @"microsoft.com",
            @"amazon.com",
            @"boomsupersonic.com",
            @"twitter.com", nil];

}


@end
