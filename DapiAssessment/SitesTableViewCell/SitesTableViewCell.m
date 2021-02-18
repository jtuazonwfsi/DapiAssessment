//
//  SitesTableViewCell.m
//  DapiAssessment
//
//  Created by mina wefky on 17/02/2021.
//

#import "SitesTableViewCell.h"

@implementation SitesTableViewCell

- (void)awakeFromNib {
    [super awakeFromNib];
    self.siteUIIameg.hidden = TRUE;
}

- (void)setSelected:(BOOL)selected animated:(BOOL)animated {
    [super setSelected:selected animated:animated];
    
    // Configure the view for the selected state
}


- (void)updateCell:(NSString*)totalBytes withImageName:(NSString*)image{
    
    self.siteResponse.text = totalBytes;
    //get image data in background
    dispatch_async(dispatch_get_global_queue(0,0), ^{
        NSString *myURLString = [@"http://www.google.com/s2/favicons?domain=www." stringByAppendingString:image];
        NSURL *myURL=[NSURL URLWithString: myURLString];
        NSData *myData=[NSData dataWithContentsOfURL:myURL];
        if (myData == nil) {
            return;
        }
        //update ui in the main thread 
        dispatch_async(dispatch_get_main_queue(), ^{
            self.siteUIIameg.hidden = FALSE;
            [self.siteUIIameg setImage:[UIImage imageWithData:myData]];
        });
    });
}

- (void)updateCellWithError:(NSString*)errorCode{
    
    self.siteResponse.text = errorCode;
    dispatch_async(dispatch_get_main_queue(), ^{
        self.siteUIIameg.hidden = FALSE;
        [self.siteUIIameg setImage:[UIImage imageNamed:@"failIcon"]];
    });
}

@end
