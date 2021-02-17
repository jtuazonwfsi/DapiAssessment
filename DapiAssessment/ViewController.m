//
//  ViewController.m
//  DapiAssessment
//
//  Created by mina wefky on 17/02/2021.
//

#import "ViewController.h"
#import "SitesTableViewCell.h"

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
    
    [self initingNavBar];
}


- (void)initingNavBar{
    self.navigationController.navigationBar.prefersLargeTitles = YES;
    self.title = @"Sites";
    UIBarButtonItem *startBtn = [[UIBarButtonItem alloc]initWithTitle:@"Start" style:UIBarButtonItemStylePlain target:self action:@selector(startBtnTapped:)];
    
    self.navigationItem.rightBarButtonItem = startBtn;
}

//MARK:- startBtn Tapped

-(IBAction)startBtnTapped:(id)sender
{
    [self createGetReusts:0];
}


//MARK:- performe serialBackgroundTask
- (void)createGetReusts:(int)requstIndex{
    //data task does not need any GCD cause it runs on diffrent thread as it has complition block
    NSString *baseURL = @"http://www.";
    NSURLSessionDataTask *dataTask;
    NSURL *url = [NSURL URLWithString:[baseURL stringByAppendingString:urls[requstIndex]]];
    dataTask =
    [[[self class] session] dataTaskWithURL:url
                          completionHandler:^(NSData *data, NSURLResponse *response, NSError *error) {
        
        // recursive way serialize the requests
        if (requstIndex< [urls count] -1){
            [self createGetReusts:requstIndex + 1];
        }
    }];
    NSLog(@"%@", dataTask);
    [dataTask resume];
}

+ (NSURLSession *)session
{
    static NSURLSession *session = nil;
    static dispatch_once_t onceToken;
    dispatch_once(&onceToken, ^{
        
        NSURLSessionConfiguration *configuration = [NSURLSessionConfiguration defaultSessionConfiguration];
        
        [configuration setHTTPMaximumConnectionsPerHost:1];
        
        session = [NSURLSession sessionWithConfiguration:configuration];
        
    });
    return session;
}


//MARK:- Table View Data source

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section{
    return [urls count];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath{
    
    static NSString *cellId = @"SitesCell";
    
    SitesTableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:cellId forIndexPath:indexPath];
    cell.siteName.text = urls[indexPath.row];
    return cell;
}

@end
